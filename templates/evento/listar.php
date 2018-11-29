{% extends "index.php" %}
{% block title %}Eventos - Listar{% endblock %}

{% block content %}
<h1>Eventos</h1>

<a href="eventos/adicionar" class="btn btn-success">Adicionar</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Opções</th>
            <th></th>
        </tr>
    </thead>
    {% for evento in eventos %}
    <tr>
        <td>{{ evento.id }}</td>
        <td>{{ evento.nome }}</td>
        <td>{{ evento.qtd_opcoes }}</td>
        <td><a href="/eventos/visualizar/{{ evento.id }}" class="btn btn-primary">Visualizar</a></td>
    </tr>
    {% endfor %}
</table>
{% endblock %}