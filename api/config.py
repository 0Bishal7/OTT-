
import mysql.connector


def connectDB():
    return mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        password="",
        database="ott",
        port=3306
    )