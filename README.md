# Django Bootstrap Blog

This is a Django website that includes a blog with a Bootstrap masonry grid post and a customizable menu. The website is served using Gunicorn and Nginx, with Apache used to serve static files.

## Installation

1. Set up a Python virtual environment and install required packages.
2. Create a Django project and app.
3. Create Django models, views, and templates for the blog.
4. Configure Gunicorn for serving the Django application.
5. Set up Nginx as a reverse proxy for Gunicorn.
6. Configure Apache to serve static files.
7. Deploy the website.

### Step 1: Set up a Python virtual environment and install required packages

#### Install Python and virtualenv:
```
sudo apt update
sudo apt install python3 python3-venv
```

#### Create a virtual environment and activate it:
```
python3 -m venv myproject_env
source myproject_env/bin/activate
```

#### Install Django, Gunicorn, and other required packages:
```
pip install django gunicorn psycopg2-binary
```

### Step 2: Create a Django project and app

#### Create a new Django project:
```
django-admin startproject myproject
```

#### Create a new Django app:
```
cd myproject
python manage.py startapp myapp
```

### Step 3: Create Django models, views, and templates for the blog

#### Create a Post model in myapp/models.py:
```
from django.db import models

class Post(models.Model):
    title = models.CharField(max_length=200)
    content = models.TextField()
    image_url = models.URLField()

    def __str__(self):
        return self.title
```

#### Register the Post model in myapp/admin.py:
```
from django.contrib import admin
from .models import Post

admin.site.register(Post)
```

#### Create a blog view in myapp/views.py:
```
from django.shortcuts import render
from .models import Post

def blog_posts(request):
    posts = Post.objects.all()
    return render(request, 'blog_posts.html', {'posts': posts})
```

#### Create a URL pattern for the blog view in myapp/urls.py:
```
from django.urls import path
from . import views

urlpatterns = [
    path('blog_posts/', views.blog_posts, name='blog_posts'),
]
```

#### Include the app's URL patterns in the project's urls.py:
```
from django.contrib import admin
from django.urls import path, include

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('myapp.urls')),
]
```

#### Create a templates directory in the root directory of your Django project:
```
mkdir templates
```

#### Create a base.html file in the templates directory:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}{% endblock %}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QLnG6e0bi+biKEQ8rFbPV13aIbhk" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">MyProject</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {% if request.path == '/blog_posts/' %}active{% endif %}">
                    <a class="nav-link" href="/blog_posts/">Blog</a>
                </li>
                <li class="nav-item {% if request.path == '/about/' %}active{% endif %}">
                    <a class="nav-link" href="/about/">About</a>
                </li>
                <!-- Add more menu items as needed -->
            </ul>
        </div>
    </nav>

    <div class="container mt-3">
        {% block content %}{% endblock %}
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QLnG6e0bi+biKEQ8rFbPV13aIbhk" crossorigin="anonymous"></script>
</body>
</html>
```

#### Create a blog_posts.html file in the templates directory:
```
{% extends "base.html" %}
{% load static %}

{% block title %}Blog Posts{% endblock %}

{% block content %}
<h1 class="mt-4 mb-3">Blog Posts</h1>
<div class="card-columns">
    {% for post in
```

### Step 4: Configure Gunicorn for serving the Django application

#### Test the Gunicorn configuration:
```
gunicorn --bind 0.0.0.0:8000 myproject.wsgi:application
```

#### Create a Gunicorn systemd service file at /etc/systemd/system/gunicorn.service:
Make sure to replace /path/to/your/project with the actual path to your Django project and /path/to/your/virtualenv with the path to your virtual environment.
```
[Unit]
Description=gunicorn daemon
After=network.target

[Service]
User=myuser
Group=www-data
WorkingDirectory=/path/to/your/project
ExecStart=/path/to/your/virtualenv/bin/gunicorn --access-logfile - --workers 3 --bind unix:/path/to/your/project/myproject.sock myproject.wsgi:application

[Install]
WantedBy=multi-user.target
```