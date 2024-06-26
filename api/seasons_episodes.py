from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os

seasons_episodes_bp = Blueprint('seasons_episodes', __name__)

@seasons_episodes_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_seasons_episodes(mainCursor):
    mainCursor.execute('SELECT * FROM ott.seasons_episodes WHERE is_trash=0', ())
    items = mainCursor.fetchall()
    response = []
    for x in items:
        response.append({
            "id": x[0],
            "season_no": x[1],
            "total_episodes": x[2],
            "episode_no": x[3],
            "movie_link": x[4],
            "movie_title": x[5],
            "duration": x[6],
            "description": x[7],
            "status": x[8],
            "is_trash": x[9],
        })
    return jsonify(response)

@seasons_episodes_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_season_episode_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.seasons_episodes SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@seasons_episodes_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_season_episode(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.seasons_episodes SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@seasons_episodes_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_season_episode(mainCursor):
    data_text = request.form
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/seasons_episodes'):
        os.makedirs('../uploads/seasons_episodes')

    # Save the uploaded image
    img_name = ''
    if 'movie_link' in data_images:
        img_name = 'uploads/seasons_episodes/' + data_images['movie_link'].filename
        data_images['movie_link'].save('../' + img_name)

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.seasons_episodes (season_no, total_episodes, episode_no, movie_link, movie_title, duration, description) VALUES (%s, %s, %s, %s, %s, %s, %s)",
        (
            data_text['season_no'],
            data_text['total_episodes'],
            data_text['episode_no'],
            img_name,
            data_text['movie_title'],
            data_text['duration'],
            data_text['description']
        )
    )
    return jsonify({'res': 1, 'message': 'New season episode entry added successfully!'})
