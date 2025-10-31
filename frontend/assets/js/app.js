$(document).ready(function() {
    var app = $.spapp({
        defaultView: "home",
        templateDir: "./views/"
    });

    app.route({
        view: "home",
        load: "home.html"
    });
        app.route({
        view: "aboutUs",
        load: "aboutUs.html"
    });
    app.route({
        view: "gallery",
        load: "gallery.html"
    });
    app.route({
        view: "booking",
        load: "booking.html"
    });
    app.route({
        view: "login",
        load: "login.html"
    });
    app.route({
        view: "register",
        load: "register.html"
    });
    

    app.run();
});