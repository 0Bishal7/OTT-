from flask import Blueprint, Flask, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os

categories_bp = Blueprint('categories', __name__)

@categories_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_categories(mainCursor):
    mainCursor.execute('SELECT * FROM ott.categories WHERE is_trash=0', ())
    categories = mainCursor.fetchall()
    response = []
    for x in categories:
        response.append({
            "id": x[0],
            "movie_link1": x[1],
            "movie_link2": x[2],
            "movie_link3": x[3],
            "movie_link4": x[4],
            "movie_type": x[5],
            "status": x[6],
            "is_trash": x[7],
        })
    return jsonify(response)

@categories_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_category_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.categories SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@categories_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_category(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.categories SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@categories_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_category(mainCursor):
    data_text = request.form
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/categories'):
        os.makedirs('../uploads/categories')

    img_paths = []
    for i in range(1, 5):
        img_key = f'movie_link{i}'
        if img_key in data_images:
            img_path = 'uploads/categories/' + data_images[img_key].filename
            data_images[img_key].save('../' + img_path)
            img_paths.append(img_path)
        else:
            img_paths.append('')

    mainCursor.execute(
        "INSERT INTO ott.categories (movie_link1, movie_link2, movie_link3, movie_link4, movie_type) VALUES (%s, %s, %s, %s, %s)",
        (
            img_paths[0],
            img_paths[1],
            img_paths[2],
            img_paths[3],
            data_text['movie_type']
        )
    )
    
    return jsonify({'res': 1, 'message': 'New category entry added successfully!'})
