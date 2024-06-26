from flask import Blueprint, Flask, render_template, jsonify, request
from dbconfig import db_connect_cmd
from flask_cors import CORS

plans_bp = Blueprint('plans', __name__)

@plans_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_plans(mainCursor):
    mainCursor.execute('SELECT * FROM ott.plans WHERE is_trash=0', ())
    items = mainCursor.fetchall()
    response = []
    for x in items:
        response.append({
            "id": x[0],
            "duration": x[1],
            "plan_name": x[2],
            "description": x[3],
            "price": x[4],
            "status": x[5],
            "is_trash": x[6],
        })
    return jsonify(response)

@plans_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_plan_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.plans SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })

@plans_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_plan(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.plans SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@plans_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_plan(mainCursor):
    data = request.form

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.plans (duration, plan_name, description, price) VALUES (%s, %s, %s, %s)",
        (
            data['duration'],
            data['plan_name'],
            data['description'],
            data['price']
        )
    )
    return jsonify({'res': 1, 'message': 'New plan added successfully!'})
