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