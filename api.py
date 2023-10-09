from flask import Flask, jsonify
import mysql.connector

app = Flask(__name__)

# MySQL database connection configuration
db = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database='test'
)

@app.route('/api/products')
def get_products():
    try:
        cursor = db.cursor(dictionary=True)
        cursor.execute('SELECT * FROM menus')
        results = cursor.fetchall()
        return jsonify(results)
    except Exception as e:
        return jsonify(error=str(e)), 500
    finally:
        cursor.close()

if __name__ == '__main__':
    app.run(debug=True)
# http://localhost:5000/api/products