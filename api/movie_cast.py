from flask import Blueprint, jsonify, request
from dbconfig import db_connect_cmd
import os

movie_cast_bp = Blueprint('movie_cast', __name__)

@movie_cast_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_movie_cast(mainCursor):
    mainCursor.execute('SELECT * FROM ott.movie_cast WHERE is_trash=0')
    movie_cast = mainCursor.fetchall()
    response = []
    for x in movie_cast:
        response.append({
            "id": x[0],
            "cast_image": x[1],
            "status": x[2],
            "is_trash": x[3],
        })
    return jsonify(response)

@movie_cast_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_movie_cast_status(mainCursor):
    Data = request.form
    status = int(Data["status"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_cast SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@movie_cast_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_movie_cast(mainCursor):
    Data = request.get_json()
    is_trash = int(Data["is_trash"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_cast SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@movie_cast_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_movie_cast(mainCursor):
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/movie_cast'):
        os.makedirs('../uploads/movie_cast')

    # Save the uploaded image
    cast_image_path = ''
    if 'cast_image' in data_images:
        cast_image_path = 'uploads/movie_cast/' + data_images['cast_image'].filename
        data_images['cast_image'].save('../' + cast_image_path)

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.movie_cast (cast_image) VALUES (%s)",
        (cast_image_path,)
    )
    
    return jsonify({'res': 1, 'message': 'New movie cast entry added successfully!'})
