from flask import Blueprint, Flask, render_template, jsonify,request
from dbconfig import db_connect_cmd
from flask_cors import CORS

faq_bp = Blueprint('faq', __name__)


@faq_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_faq(mainCursor):
    mainCursor.execute('SELECT * FROM ott.faq WHERE is_trash=0', ())
    faq = mainCursor.fetchall()
    response = []
    for x in faq:
        response.append({
            "id": x[0],
            "question": x[1],
            "answer":x[2],
            "status": x[3],
            "is_trash": x[4],
        })

    return jsonify(response)



@faq_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_faq_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.faq SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })




@faq_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_faq(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.faq SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })


@faq_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_faq(mainCursor):
    data = request.get_json()
    mainCursor.execute(
        "INSERT INTO ott.faq (question, answer) VALUES (%s, %s)",
        (
            data['question'],
            data['answer']
        )
    )
    
    return jsonify({'res': 1, 'message': 'New FAQ entry added successfully!'})
