{%html framework="common:static/mod.js"%}
  {%head%}
    <meta charset='utf-8'>
    <title>{%$site.title%}</title>
    {%require name="common:static/reset.css"%}
    {%require name="common:static/layout.less"%}
  {%/head%}

  {%body id="screen"%}
    <div id="container">
      {%widget name="common:widget/header/header.tpl"%}
      <div class="main">
        {%block name="main"%}{%/block%}
      </div>
      {%widget name="common:widget/footer/footer.tpl"%}
    </div>
  {%/body%}

{%/html%}