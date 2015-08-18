{%extends file="common/page/layout.tpl"%}
{%block name="main"%}
  {%widget name="A:widget/post-list/post-list.tpl" posts=$data.posts%}
{%/block%}