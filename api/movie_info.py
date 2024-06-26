from flask import Blueprint, jsonify, request
from dbconfig import db_connect_cmd

movie_info_bp = Blueprint('movie_info', __name__)

@movie_info_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_movie_info(mainCursor):
    mainCursor.execute('SELECT * FROM ott.movie_info WHERE is_trash=0')
    movie_info = mainCursor.fetchall()
    response = []
    for x in movie_info:
        response.append({
            "id": x[0],
            "released": x[1],
            "language": x[2],
            "rating": x[3],
            "genres": x[4],
            "director": x[5],
            "music": x[6],
            "status": x[7],
            "is_trash": x[8],
        })
    return jsonify(response)

@movie_info_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_movie_info_status(mainCursor):
    Data = request.form
    status = int(Data["status"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_info SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@movie_info_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_movie_info(mainCursor):
    Data = request.get_json()
    is_trash = int(Data["is_trash"])
    id = int(Data["id"])

    mainCursor.execute('UPDATE ott.movie_info SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@movie_info_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_movie_info(mainCursor):
    Data = request.form
    released = int(Data['released'])
    language = Data['language']
    rating = Data['rating']
    genres = Data['genres'],
    director = Data['director']
    music = Data['music']

    mainCursor.execute(
        "INSERT INTO ott.movie_info (released, language, rating, genres, director, music) VALUES (%s, %s, %s, %s, %s, %s)",
        (released, language, rating, genres, director, music)
    )
    
    return jsonify({'res': 1, 'message': 'New movie info added successfully!'})



    # Extract data from the request
    released = data.get('released')
    language = data.get('language')
    rating = data.get('rating')
    gernes = data.get('gernes')  # Ensure this matches the input field in your form
    director = data.get('director')
    music = data.get('music')

    try:
        # Execute the SQL query to insert data into movie_info table
        mainCursor.execute(
            "INSERT INTO movie_info (released, language, rating, gernes, director, music) VALUES (%s, %s, %s, %s, %s, %s)",
            (released, language, rating, gernes, director, music)
        )

        # Commit the transaction
        mainCursor.connection.commit()

        # Return a success response
        return jsonify({'res': 1, 'message': 'New movie info added successfully!'})

    except Exception as e:
        # Handle exceptions here, e.g., rollback transaction on failure
        mainCursor.connection.rollback()
        return jsonify({'res': 0, 'message': f'Failed to add movie info: {str(e)}'})

