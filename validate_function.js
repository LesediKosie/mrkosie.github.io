<
html >
    <
    head >

    <
    title > Registration < /title> <
    style >

    .Login {
        border: 1 px solid #999999;

			font:normal 14px helvetia;

			color:# 444444;
    } <
    /style> <
    script >
    function validate(form) {
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        if (fail == "") return true
        else(alert(fail);
            return false
        }
    } <
    />

<
/head> <
body >
    <
    table class "login"
border = "0"
cellpadding = "2"
cellpadding = "5"
bgcolor = "#eeeeee" >
    <
    th > colspan = "2"
align = "center" > Login < /th> <
    form method = "post"
action = "index.php"
onsubmit = "return validate(this)" >
    <
    tr > < td > Username < /td> <
    td < input type = "text"
maxlength = "32"
name = "username" > < /td></tr >

    <
    tr > < td > Passwotd < /td> <
    td < input type = "text"
maxlength = "32"
name = "password" > < /td></tr >


    <
    tr > < td colspan = "2"
align = "center" > < input type = "submit"
value = "login" > < /td></tr >

    <
    script >
    function validateUsername(field) {
        return (field == "") ? "No Username was entered.\n" : ""
    }

function validatePassword(field) {
    return (field == "") ? "No Password was entered.\n" : ""
}

function validateUsername(field) {
    if (field == "") return "No username was entered.\n"
    else if (field.length < 5)
        return "Username must be at least 5 characters.\n"
    else if (/[^a-zA-Z0-9_-]/test (field)))
retun "Only a-z, A-Z, 0-9, - and _ allowed on username.\n"
return ""
}

function validatePassword(field) {
    if (field == "") return "No assword was entered.\n"
    ese
    if (!/[a-z]/.test(field) || !/ [A-Z]/.test(field) || !/[0-9]/.test(field))
        return " password requires one each of a-z,A-Z and 0-9.\n"

} <
/script> <
/form> <
/table> <
/body>

<
/html> <
script >
    function validateUsername(field) {
        return (field == "") ? "No Username was entered.\n" : ""
    }

function validatePassword(field) {
    return (field == "") ? "No Password was entered.\n" : ""
}

function validateUsername(field) {
    if (field == "") return "No username was entered.\n"
    else if (field.length < 5)
        return "Username must be at least 5 characters.\n"
    else if (/[^a-zA-Z0-9_-]/test (field)))
retun "Only a-z, A-Z, 0-9, - and _ allowed on username.\n"
return ""
}

function validatePassword(field) {
    if (field == "") return "No assword was entered.\n"
    ese
    if (!/[a-z]/.test(field) || !/ [A-Z]/.test(field) || !/[0-9]/.test(field))
        return " password requires one each of a-z,A-Z and 0-9.\n"

} <
/script>