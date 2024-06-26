from flask import Flask, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)



from categories import categories_bp
from faq import faq_bp
from slider import slider_bp
from movie_cast import movie_cast_bp
from movie_description import movie_description_bp
from movie_info import movie_info_bp
from movie_reviews import movie_reviews_bp
from must_watch import must_watch_bp
from new_releases import new_releases_bp
from plans import plans_bp
from seasons_episodes import seasons_episodes_bp
from support import support_bp





# seasons_episodes

app.register_blueprint(categories_bp, url_prefix='/categories')

app.register_blueprint(faq_bp,url_prefix="/faq")
app.register_blueprint(slider_bp,url_prefix="/slider")
app.register_blueprint(movie_cast_bp,url_prefix="/movie_cast")
app.register_blueprint(movie_description_bp,url_prefix="/movie_description")
app.register_blueprint(movie_info_bp,url_prefix="/movie_info")
app.register_blueprint(movie_reviews_bp,url_prefix="/movie_reviews")
app.register_blueprint(must_watch_bp,url_prefix="/must_watch")
app.register_blueprint(new_releases_bp,url_prefix="/new_releases")
app.register_blueprint(plans_bp,url_prefix="/plans")
app.register_blueprint(seasons_episodes_bp,url_prefix="/seasons_episodes")
app.register_blueprint(support_bp,url_prefix="/support")
















if __name__ == '__main__':
    app.run(port=7452, debug=True)
