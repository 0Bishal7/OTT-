from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os

movie_reviews_bp = Blueprint('movie_reviews', __name__)

@movie_reviews_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_movie_reviews(mainCursor):
    mainCursor.execute('SELECT * FROM ott.movie_reviews WHERE is_trash=0', ())
    reviews = mainCursor.fetchall()
    response = []
    for x in reviews:
        response.append({
            "id": x[0],
            "name": x[1],
            "country": x[2],
            "rating": x[3],
            "description": x[4],
            "status": x[5],
            "is_trash": x[6],
        })
    return jsonify(response)

@movie_reviews_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_movie_review_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.movie_reviews SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@movie_reviews_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_movie_review(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.movie_reviews SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@movie_reviews_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_movie_review(mainCursor):
    data_text = request.form

    mainCursor.execute(
        "INSERT INTO ott.movie_reviews (name, country, rating, description) VALUES (%s, %s, %s, %s)",
        (
            data_text['name'],
            data_text['country'],
            data_text['rating'],
            data_text['description']
        )
    )
    return jsonify({'res': 1, 'message': 'New movie review added successfully!'})
