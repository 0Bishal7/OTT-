from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os

must_watch_bp = Blueprint('must_watch', __name__)

@must_watch_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_must_watch(mainCursor):
    mainCursor.execute('SELECT * FROM ott.must_watch WHERE is_trash=0', ())
    items = mainCursor.fetchall()
    response = []
    for x in items:
        response.append({
            "id": x[0],
            "movie_link": x[1],
            "time": x[2],
            "rating": x[3],
            "status": x[4],
            "is_trash": x[5],
        })
    return jsonify(response)

@must_watch_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_must_watch_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.must_watch SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@must_watch_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_must_watch(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.must_watch SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@must_watch_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_must_watch(mainCursor):
    data_text = request.form
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/must_watch'):
        os.makedirs('../uploads/must_watch')

    # Save the uploaded image
    img_name = ''
    if 'movie_link' in data_images:
        img_name = 'uploads/must_watch/' + data_images['movie_link'].filename
        data_images['movie_link'].save('../'+img_name)

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.must_watch (movie_link, time, rating) VALUES (%s, %s, %s)",
        (
            img_name,
            data_text['time'],
            data_text['rating']
        )
    )
    return jsonify({'res': 1, 'message': 'New must watch entry added successfully!'})
