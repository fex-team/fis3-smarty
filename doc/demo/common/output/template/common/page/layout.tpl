{%html framework="common:static/mod.js"%}
{%head%}
<meta charset='utf-8'>
<title>{%$site.title|f_escape_xml%}</title>
{%/head%}
{%body id="screen"%}
{%widget name="common:widget/header/header.tpl"%}
{%block name="main"%}{%/block%}
{%widget name="common:widget/footer/footer.tpl"%}
{%require name='common:page/layout.tpl'%}{%/body%}
{%/html%}