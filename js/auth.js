const changeStatus = (id, status, index,t_name) => {
    const controller = `http://127.0.0.1:7452/${t_name}/change_status`
    var formData = new FormData();
    formData.append('id', id);
    formData.append('status', status && status == 1 ? 0 : 1);
    $.ajax({
        type: 'POST',
        url: controller,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: (response) => {
            eval(t_name)()
        },
        error: (xhr, status, error) => {
            console.error(`Error: ${status} - ${error}`);
            alert('Error Changing status!');
        }
    });
}

const removeRecord = (id, is_trash, index,t_name) => {
    console.log(id, is_trash, index)
    const controller = `http://127.0.0.1:7452/${t_name}/delete`
    const body = {
        id: id,
        is_trash: is_trash && is_trash == 1 ? 0 : 1
    }

    $.ajax({
        url: controller,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(body),
        success: (response) => {
            if (response.res === 1) {
                console.log(response.Msg);
                eval(t_name)()
            }
        },
        error: (xhr, status, error) => {
            console.error(`Error: ${status} - ${error}`);
        }
    });
}

//faq
const faq = () => {
    $("#faq").empty();

    const controller = "http://127.0.0.1:7452/faq/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.question}</td>
                <td>${val.answer}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'faq')"></i></td>
                
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'faq')"></i></td>

            </tr>`;
            $("#faq").append(temp_html);
        });
    });
}


// slider
const slider = () => {
    $("#slider").empty();
    const controller = "http://127.0.0.1:7452/slider/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.title}</td>
                <td>${val.description}</td>
                <td><img src="${val.image_path}" alt="${val.title}" width="100" height="100" /></td>

                <td>${val.button_link}</td>
                <td>${val.other_link}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'slider')"></i></td>
                
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'slider')"></i></td>

            </tr>`;
            $("#slider").append(temp_html);
        });
    });
}



const categories = () => {
    $("#categories").empty();
    const controller = "http://127.0.0.1:7452/categories/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td><img src="${val.movie_link1}" alt="Movie Link 1" width="100" height="100" /></td>
                <td><img src="${val.movie_link2}" alt="Movie Link 2" width="100" height="100" /></td>
                <td><img src="${val.movie_link3}" alt="Movie Link 3" width="100" height="100" /></td>
                <td><img src="${val.movie_link4}" alt="Movie Link 4" width="100" height="100" /></td>
                <td>${val.movie_type}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'categories')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'categories')"></i></td>
            </tr>`;
            $("#categories").append(temp_html);
        });
    });
}

//movie_cast
const movie_cast =() => {
    $("#movie_cast").empty();
    const controller = "http://127.0.0.1:7452/movie_cast/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td><img src="${val.cast_image}" alt="Cast Image" width="100" height="100" /></td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'movie_cast')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'movie_cast')"></i></td>
            </tr>`;
            $("#movie_cast").append(temp_html);
        });
    });
}



const movie_description =()=> {
    $("#movie_description").empty();
    const controller = "http://127.0.0.1:7452/movie_description/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.description}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'movie_description')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'movie_description')"></i></td>
            </tr>`;
            $("#movie_description").append(temp_html);
        });
    });
}

// movie_info
const movie_info =()=> {
    $("#movie_info").empty();
    const controller = "http://127.0.0.1:7452/movie_info/list";
    const filter = {};
    $.getJSON(controller, filter, (result) => {
        console.log(result);
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.released}</td>
                <td>${val.language}</td>
                <td>${val.rating}</td>
                <td>${val.genres}</td>
                <td>${val.director}</td>
                <td>${val.music}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'movie_info')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'movie_info')"></i></td>
            </tr>`;
            $("#movie_info").append(temp_html);
        });
    });
}


// movie_reviews
const movie_reviews = () => {
    $("#movie_reviews").empty();
    const controller = "http://127.0.0.1:7452/movie_reviews/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.name}</td>
                <td>${val.country}</td>
                <td>${val.rating}</td>
                <td>${val.description}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'movie_reviews')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'movie_reviews')"></i></td>
            </tr>`;
            $("#movie_reviews").append(temp_html);
        });
    });
}


// must_watch
const must_watch = () => {
    $("#must_watch").empty();
    const controller = "http://127.0.0.1:7452/must_watch/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td><img src="${val.movie_link}" alt="Movie Image" width="100" height="100" /></td>
                <td>${val.time}</td>
                <td>${val.rating}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'must_watch')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'must_watch')"></i></td>
            </tr>`;
            $("#must_watch").append(temp_html);
        });
    });
}
// new_releases
const new_releases = () => {
    $("#new_releases").empty();
    const controller = "http://127.0.0.1:7452/new_releases/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td><img src="${val.movie_link}" alt="Movie Image" width="100" height="100" /></td>
                <td>${val.release_date}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'new_releases')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'new_releases')"></i></td>
            </tr>`;
            $("#new_releases").append(temp_html);
        });
    });
}
// plans
const plans = () => {
    $("#plans").empty();
    const controller = "http://127.0.0.1:7452/plans/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.duration}</td>
                <td>${val.plan_name}</td>
                <td>${val.description}</td>
                <td>${val.price}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'plans')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'plans')"></i></td>
            </tr>`;
            $("#plans").append(temp_html);
        });
    });
}

// seasons_episodes
const seasons_episodes = () => {
    $("#seasons_episodes").empty();
    const controller = "http://127.0.0.1:7452/seasons_episodes/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.season_no}</td>
                <td>${val.total_episodes}</td>
                <td>${val.episode_no}</td>
                <td><img src="${val.movie_link}" alt="Image" height="100" width="100"></td>
                <td>${val.movie_title}</td>
                <td>${val.duration}</td>
                <td>${val.description}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'seasons_episodes')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'seasons_episodes')"></i></td>
            </tr>`;
            $("#seasons_episodes").append(temp_html);
        });
    });
}

// support
const support = () => {
    $("#support").empty();
    const controller = "http://127.0.0.1:7452/support/list";
    $.getJSON(controller, {}, (result) => {
        let temp_html = "";
        $.each(result, (index, val) => {
            temp_html = `<tr>
                <td>${val.id}</td>
                <td>${val.first_name}</td>
                <td>${val.last_name}</td>
                <td>${val.email}</td>
                <td>${val.phone_no}</td>
                <td>${val.message}</td>
                <td><i class="fa p-cursor fa-${val.status ? 'toggle-on' : 'toggle-off'}" onclick="changeStatus(${val.id}, ${val.status}, ${index},'support')"></i></td>
                <td><i class="fa fa-trash p-cursor" onclick="removeRecord(${val.id}, ${val.is_trash}, ${index},'support')"></i></td>
            </tr>`;
            $("#support").append(temp_html);
        });
    });
}



$(document).ready(function () {

    faq();
    slider();
    categories();
    movie_cast();
    movie_description();
    movie_info();
    movie_reviews();
    must_watch();
    new_releases();
    plans();
    seasons_episodes();
    support();
});