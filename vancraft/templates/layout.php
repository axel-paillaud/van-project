<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="fonts.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="icons.css" rel="stylesheet">
    <title>{% block title %}Vancraft{% endblock %}</title>
</head>
<body>
    {% block header %}{% include 'header/header.php' %}{% endblock %}

    {% block sidebar %}{% include 'sidebar/sidebar.php' %}{% endblock %}

    {% block content %}{% include 'sidebar/sidebar.php' %}{% endblock %}

    {% block footer %}{% include 'footer/footer.php' %}{% endblock %}
</body>
</html>
