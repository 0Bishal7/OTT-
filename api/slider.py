from flask import Blueprint, Flask, render_template, jsonify,request
from dbconfig import db_connect_cmd
from flask_cors import CORS
import os
slider_bp = Blueprint('slider', __name__)


@slider_bp.route('/list', methods=['GET'])
@db_connect_cmd
def get_slider(mainCursor):
    mainCursor.execute('SELECT * FROM ott.slider WHERE is_trash=0', ())
    slider = mainCursor.fetchall()
    response = []
    for x in slider:
        response.append({
            "id": x[0],
            "title": x[1],
            "description":x[2],
            "image_path":x[3],
            "button_link":x[4],
            "other_link":x[5],
            "status": x[6],
            "is_trash": x[7],
        })
    # print("Response data: ", response)
    return jsonify(response)



@slider_bp.route('/change_status', methods=['POST'])
@db_connect_cmd
def change_slider_status(mainCursor):
    Data = request.form
    status = Data["status"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.slider SET status = %s WHERE id = %s', (status, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Updated."
    })




@slider_bp.route('/delete', methods=['POST'])
@db_connect_cmd
def delete_slider(mainCursor):
    Data = request.get_json()
    is_trash = Data["is_trash"]
    id = Data["id"]

    mainCursor.execute('UPDATE ott.slider SET is_trash = %s WHERE id = %s', (is_trash, id))
    return jsonify({
        "res": 1,
        "Msg": "Successfully Removed."
    })

@slider_bp.route('/add', methods=['POST'])
@db_connect_cmd
def add_slider(mainCursor):
    data_text = request.form
    data_images = request.files

    # Create upload directory if it doesn't exist
    if not os.path.exists('../uploads/slider'):
        os.makedirs('../uploads/slider')

    # Save the uploaded image
    img_name = ''
    if 'image_path' in data_images:
        img_name = 'uploads/slider/' + data_images['image_path'].filename
        data_images['image_path'].save('../'+img_name)

    # Insert data into the database
    mainCursor.execute(
        "INSERT INTO ott.slider (title, description, image_path, button_link, other_link) VALUES (%s, %s, %s, %s, %s)",
        (
            data_text['title'],
            data_text['description'],
            img_name,
            data_text['button_link'],
            data_text['other_link']
        )
    )
    
    return jsonify({'res': 1, 'message': 'New slider entry added successfully!'})
