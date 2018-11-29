{% extends "index.php" %}
{% block title %}Eventos - Adicionar{% endblock %}

{% block content %}
<link href="templates/assets/css/evento.css" rel="stylesheet">
<h1>Eventos - Adicionar</h1>

{% if erro %}
<div class="warning">
    {{ erro }}
</div>
{% endif %}

<form action="eventos/adicionar" method="post">

    <div class="form-group">
        <label for="inputNome">Nome </label>
        <input type="text" class="form-control" id="inputNome" name="nome" value="{% if evento.nome %}{{ evento.nome }}{% endif %}"
            required {% if disabled %} disabled="disabled" {% endif %} />
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="inputCidade">Cidade</label>
            <input type="text" class="form-control" id="inputCidade" name="cidade" required value="{% if evento.cidade %}{{ evento.cidade }}{% endif %}"
                {% if disabled %} disabled="disabled" {% endif %} />
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">Estado</label>
            {% if disabled %}
            <input type="text" class="form-control" value="{% if evento.uf %}{{ evento.uf }}{% endif %}" disabled="disabled" />
            {% else %}
            <select id="inputState" class="form-control" name="uf">
                <option value="sc" {% if evento.uf=='sc' %} selected="selected" {% endif %}>SC</option>
                <option value="pr" {% if evento.uf=='pr' %} selected="selected" {% endif %}>PR</option>
            </select>
            {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="inputDescricao">Descrição</label>
        <textarea class="form-control {% if disabled %} disabledtextarea {%endif %}" id="inputDescricao" name="descricao" {% if disabled %} readonly="readonly" {%endif %}>{% if evento.descricao %}{{ evento.descricao }}{% endif %}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="inputPreco">Preço</label>
            <input type="text" class="form-control" id="inputPreco" name="preco" required value="{% if evento.precobase %}{{ evento.precobase }}{% endif %}"
                {% if disabled %} disabled="disabled" {% endif %} />
        </div>
        <div class="form-group col-md-5">
            <label for="inputIni">Inicio</label>
            <input type="date" class="form-control" id="inputIni" name="inicio" required value="{% if evento.dia_inicio %}{{ evento.dia_inicio }}{% endif %}"
                {% if disabled %} disabled="disabled" {% endif %} />
        </div>
        <div class="form-group col-md-5">
            <label for="inputFim">Final</label>
            <input type="date" class="form-control" id="inputFim" name="fim" required value="{% if evento.dia_fim %}{{ evento.dia_fim }}{% endif %}"
                {% if disabled %} disabled="disabled" {% endif %} />
        </div>
    </div>

    {% if not disabled %}
    <input type="button" class="btn btn-primary" value="Adicionar Ingresso" onclick="adicionar_ingresso();">
    {% endif %}
    <div id="ingressos_container">
            <h3>Tipo de Ingressos</h3>

        {% if ingressos is not empty %}

        {% for ingresso in ingressos %}

         {% include 'evento/tipoingresso.php'
            with {
                'disabled': true,
                'id': ingresso.id,
                'descricao': ingresso.descricao,
                'lote': ingresso.lote,
                'valor': ingresso.valor,
                'qtd_max': ingresso.qtd_max,
                'dia_inicio': ingresso.dia_inicio,
                'dia_fim': ingresso.dia_fim,
                'observacao': ingresso.observacao
            }   
        %}
        {% endfor %}

        {% endif %}

    </div>

    {% if not disabled %}
    <input type="submit" class="btn btn-success" value="Adicionar">
    {% endif %}
</form>

<script src="templates/assets/js/evento.js"></script>
{% endblock %}