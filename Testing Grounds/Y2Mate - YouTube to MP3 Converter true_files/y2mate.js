var parameter, gA = 0, gBackend = String.fromCharCode(109, 110, 117, 117, 46, 110, 117), gDownload = false, gFormat = "mp3", gProgress = ["extracting video information", "loading video", "converting video"], gVideo = false;

function create(element) {
    return window.document.createElement(element);
}

function id(elementId) {
    return window.document.getElementById(elementId);
}

function select(selector) {
    return window.document.querySelectorAll(selector);
}

function application() {
    var button = null;
    try {
        if (/android|ipad|iphone|mobile/.test(navigator.userAgent.toLowerCase())) {
            button = create("button");
            button.innerText = "Get ByClickDownloader";
            button.onclick = function () {
                window.open(atob("aHR0cHM6Ly93d3cuYnljbGlja2Rvd25sb2FkZXIuY29tLz9zb3VyY2U9eXRtcDMmaW5uZXJwYWdlPXkybWF0ZS1udQ=="));
            };
            button.type = "button";
        }
    } catch (e) {}
    return button;
}

function k(e) {
    var result = '';
    for (var i = 0; i < atob(gC[0]).split(gC.f[6]).length; i++) {
        result += (0 < gC.f[5] ? gC[1].split("").reverse().join("") : gC[1])[atob(gC[0]).split(gC.f[6])[i] - gC.f[4]];
    }
    if (1 == gC.f[2]) {
        result = result.toLowerCase();
    } else if (2 == gC.f[2]) {
        result = result.toUpperCase();
    }
    if (0 < gC.f[1].length) {
        return gC.f[1];
    } else if (0 < gC.f[3]) {
        return result.substring(0, gC.f[3] + 1);
    } else {
        return result;
    }
}

function api(url, title, restart, attempt) {
    gA = 1;
    if (!restart) {
        select("form span")[0].innerHTML = "restarting conversion";
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            switch (response.status) {
                case "fail":
                    error(3, url, true);
                    break;
                case "ok":
                    if (!title) {
                        title = true;
                        select("form div:first-of-type")[0].innerHTML = response.title;
                    }
                    download(response.link);
                    break;
                case "processing":
                    if (response.title.length > 0 && !title) {
                        title = true;
                        select("form div:first-of-type")[0].innerHTML = response.title;
                    }
                    if (attempt == 0) {
                        attempt++;
                        select("form span")[0].innerHTML = "converting video";
                    }
                    window.setTimeout(function () {
                        api(url, title, restart, attempt);
                    }, 9000);
            }
        }
    };
    var rapidapi = String.fromCharCode(114, 97, 112, 105, 100, 97, 112, 105);
    xhr.open("GET", "https://youtube-mp36.p." + rapidapi + ".com/dl?id=" + gVideo + "&_=" + Math.random(), true);
    xhr.setRequestHeader("x-" + rapidapi + "-host", gC.r[0] + rapidapi + ".com");
    xhr.setRequestHeader("x-" + rapidapi + "-key", gC.r[1]);
    xhr.send();
}

function error(code, url, restart) {
    if (code == 3 && !restart) {
        api(url, false, false, 0);
        return false;
    }
    var button = create("button");
    button.innerText = "Back";
    button.onclick = function () {
        window.location.href = "/";
    };
    button.type = "button";
    select("form div:first-of-type")[0].style.textAlign = "center";
    select("form div:first-of-type")[0].innerHTML = "An error occurred (f:" + code + "/e:" + url + ").";
    select("form div:last-of-type")[0].style.justifyContent = "center";
    select("form div:last-of-type")[0].id = "";
    select("form div:last-of-type")[0].innerHTML = "";
    select("form div:last-of-type")[0].append(button);
    if (url != 12) {
        var appButton = application();
        if (appButton) {
            select("form div:last-of-type")[0].append(appButton);
        }
    }
    return false;
}

function download(url, title) {
    if (title) {
        select("form div:first-of-type")[0].innerHTML = title;
    }
    var buttons = [];
    buttons[0] = create("button");
    buttons[0].innerText = "Download";
    buttons[0].onclick = function () {
        if (gC.f[0] != 0 || gDownload) {
            window.location.href = url + "&s=3&v=" + gVideo + "&f=" + gFormat + "&_=" + Math.random();
        } else {
            gDownload = true;
            window.open("https://" + gBackend + "/" + gA + "/");
            window.location.href = url + "&s=3&v=" + gVideo + "&f=" + gFormat + "&_=" + Math.random();
        }
    };
    buttons[0].type = "button";
    buttons[1] = create("button");
    buttons[1].innerText = "Next";
    buttons[1].onclick = function () {
        if (gC.f[0] == 0) {
            window.location.href = "/";
        } else {
            window.location.href = document.URL;
        }
    };
    buttons[1].type = "button";
    select("form div:last-of-type")[0].style.justifyContent = "center";
    select("form div:last-of-type")[0].id = "";
    select("form div:last-of-type")[0].innerHTML = "";
    select("form div:last-of-type")[0].append(buttons[0], buttons[1]);
    var appButton = application();
    if (appButton) {
        select("form div:last-of-type")[0].append(appButton);
    }
}

function fProgress(progressUrl, downloadUrl, title, step) {
    switch (step) {
        case 0:
            select("form span")[0].innerHTML = gProgress[0];
            break;
        case 2:
            select("form div:first-of-type")[0].innerHTML = title;
            select("form span")[0].innerHTML = gProgress[1];
            break;
        case 4:
            select("form span")[0].innerHTML = gProgress[2];
    }
    if (step < gC.c[2]) {
        step++;
        window.setTimeout(function () {
            fProgress(progressUrl, downloadUrl, title, step);
        }, 3000);
    } else {
        download(downloadUrl, false);
    }
}

function progress(progressUrl, downloadUrl, title, step) {
    if (step === false) {
        select("form span")[0].innerHTML = gProgress[0];
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.error > 0) {
                error(3, response.error, false);
            }
            if (response.title.length > 0 && !title) {
                title = true;
                select("form div:first-of-type")[0].innerHTML = response.title;
            }
            if (response.progress != step) {
                step = response.progress;
                select("form span")[0].innerHTML = gProgress[step];
            }
            if (response.progress < 3) {
                window.setTimeout(function () {
                    progress(progressUrl, downloadUrl, title, step);
                }, 3000);
            } else {
                download(downloadUrl, false);
            }
        } else if (xhr.readyState == 4 && xhr.status == 429) {
            error(4, 1, false);
        }
    };
    xhr.open("GET", progressUrl, true);
    xhr.send();
}

function initialize(convertUrl, restart) {
    select("form span")[0].innerHTML = "initializing conversion";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.error > 0) {
                error(2, response.error, false);
            }
            if (restart && gC.c[0]) {
                fProgress(response.progressURL, response.downloadURL, response.title, 0);
            } else if (restart && !gC.c[0]) {
                download(response.downloadURL, response.title);
            } else if (response.redirect > 0) {
                initialize(response.redirectURL, true);
            } else {
                progress(response.progressURL, response.downloadURL, false, false);
            }
        } else if (xhr.readyState == 4 && xhr.status == 429) {
            error(4, 1, false);
        }
    };
}