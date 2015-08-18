<section class="w-post-list">
  <ul>
    {%foreach $posts as $post%}
      <li>
        {%widget name="A:widget/post-list-item/post-list-item.tpl" call="post_list_item" post=$post%}
      </li>
    {%/foreach%}
  </ul>
</section>