from flask import Blueprint, jsonify, request
from dbconfig import db_connect_cmd

movie_description_bp = Blueprint('movie_description', __name__)

@movie_description_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_movie_descriptions(mainCursor):
    mainCursor.execute('SELECT * FROM ott.movie_description WHERE is_trash=0')
    movie_descriptions = mainCursor.fetchall()
    response = []
    for x in movie_descriptions:
        response.append({
            "id": x[0],
            "description": x[1],
            "status": x[2],
            "is_trash": x[3],
        })
    return jsonify(response)

@movie_description_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_movie_description_status(mainCursor):
    Data = request.form
    status = int(Data["status"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_description SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@movie_description_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_movie_description(mainCursor):
    Data = request.get_json()
    is_trash = int(Data["is_trash"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_description SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@movie_description_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_movie_description(mainCursor):
    Data = request.form
    description = Data['description']

    mainCursor.execute(
        "INSERT INTO ott.movie_description (description) VALUES (%s)",
        (description,)
    )
    
    return jsonify({'res': 1, 'message': 'New movie description added successfully!'})
