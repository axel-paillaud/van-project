<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/regular.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>{% block title %}Vancraft{% endblock %}</title>
</head>
<body>
    {% block header %}
        {% if user %}
            {% include 'header/header_log.php' %}
        {% else %}
            {% include 'header/header.php' %}
        {% endif %}
    {% endblock %}

    {% block sidebar %}{% include 'sidebar/sidebar.php' %}{% endblock %}

    {% block content %}{% include 'sidebar/sidebar.php' %}{% endblock %}

    {% block footer %}{% include 'footer/footer.php' %}{% endblock %}
</body>
</html>
