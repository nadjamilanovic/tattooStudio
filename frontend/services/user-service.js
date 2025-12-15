var UserService = {
    init: function () {
        var token = localStorage.getItem("user_token");
        if (token && token !== undefined) {
            window.location.replace("index.html");
        }
        $("#login-form").validate({
            submitHandler: function (form) {
                var entity = Object.fromEntries(new FormData(form).entries());
                UserService.login(entity);
            },
        });
    },

    login: function (entity) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "auth/login",
            type: "POST",
            data: JSON.stringify(entity),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
                console.log(result);
                localStorage.setItem("user_token", result.data.token);
                window.location.replace("index.html");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest?.responseText ? XMLHttpRequest.responseText : 'Error');
            },
        });
    },

    logout: function () {
        localStorage.clear();
        window.location.replace("login.html");
    },

    generateMenuItems: function(){
        const token = localStorage.getItem("user_token");
        const user = Utils.parseJwt(token)?.user;

        if (user && user.role){
            let nav = "";
            let main = "";
            switch(user.role) {
                case Constants.USER_ROLE:
                    nav = `
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#appointments">Appointments</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#artists">Artists</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <button class="btn btn-primary" onclick="UserService.logout()">Logout</button>
                        </li>
                    `;
                    main = `
                        <section id="appointments" data-load="appointments.html"></section>
                        <section id="artists" data-load="artists.html"></section>
                    `;
                    break;

                case Constants.ADMIN_ROLE:
                    nav = `
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#appointments">Appointments</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#artists">Artists</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#manage">Manage Users</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <button class="btn btn-primary" onclick="UserService.logout()">Logout</button>
                        </li>
                    `;
                    main = `
                        <section id="appointments" data-load="appointments.html"></section>
                        <section id="artists" data-load="artists.html"></section>
                        <section id="manage" data-load="users.html"></section>
                    `;
                    break;

                default:
                    nav = "";
                    main = "";
            }

            $("#tabs").html(nav);
            $("#spapp").html(main);
        } else {
            window.location.replace("login.html");
        }
    }
};

UserService.init();
