from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS

support_bp = Blueprint('support', __name__)

@support_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_support(mainCursor):
    mainCursor.execute('SELECT * FROM ott.support WHERE is_trash=0', ())
    items = mainCursor.fetchall()
    response = []
    for x in items:
        response.append({
            "id": x[0],
            "first_name": x[1],
            "last_name": x[2],
            "email": x[3],
            "phone_no": x[4],
            "message": x[5],
            "status": x[6],
            "is_trash": x[7],
        })
    return jsonify(response)

@support_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_support_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.support SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@support_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_support(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.support SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@support_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_support(mainCursor):
    data = request.form
    mainCursor.execute(
        "INSERT INTO ott.support (first_name, last_name, email, phone_no, message) VALUES (%s, %s, %s, %s, %s)",
        (
            data['first_name'],
            data['last_name'],
            data['email'],
            data['phone_no'],
            data['message']
        )
    )
    return jsonify({'res': 1, 'message': 'Support message added successfully!'})
