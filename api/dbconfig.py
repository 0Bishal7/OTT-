from functools import wraps

from config import connectDB



def db_connect_cmd(func):

    @wraps(func)
    def wrapper(*args, **kwargs):
        conn = None
        cursor = None
        try:
            conn = connectDB()
            try:
                cursor = conn.cursor()
                result = func(cursor, *args, **kwargs)
                conn.commit()
                return result
            except Exception:
                conn.rollback()
                raise
            finally:
                if cursor is not None:
                    cursor.close()
        finally:
            if conn is not None:
                conn.close()

    return wrapper