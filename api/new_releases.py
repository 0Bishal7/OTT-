from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os

new_releases_bp = Blueprint('new_releases', __name__)

@new_releases_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_new_releases(mainCursor):
    mainCursor.execute('SELECT * FROM ott.new_releases WHERE is_trash=0', ())
    items = mainCursor.fetchall()
    response = []
    for x in items:
        response.append({
            "id": x[0],
            "movie_link": x[1],
            "release_date": x[2],
            "status": x[3],
            "is_trash": x[4],
        })
    return jsonify(response)

@new_releases_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_new_releases_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.new_releases SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@new_releases_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_new_releases(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.new_releases SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@new_releases_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_new_releases(mainCursor):
    data_text = request.form
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/new_releases'):
        os.makedirs('../uploads/new_releases')

    # Save the uploaded image
    img_name = ''
    if 'movie_link' in data_images:
        img_name = 'uploads/new_releases/' + data_images['movie_link'].filename
        data_images['movie_link'].save('../'+img_name)

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.new_releases (movie_link, release_date) VALUES (%s, %s)",
        (
            img_name,
            data_text['release_date']
        )
    )
    return jsonify({'res': 1, 'message': 'New release entry added successfully!'})
