<!-- File: /app/View/Posts/index.ctp -->

<h1>All Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?>&nbsp;&nbsp;
<?php echo $this->Html->link('Your Post', array('controller' => 'Posts','action' => 'index')); ?>&nbsp;&nbsp;
<?php echo $this->Html->link('All Users', array('controller' => 'Users','action' => 'index')); ?>&nbsp;&nbsp;
<?php echo $this->Html->link('Logout', array('controller' => 'Users','action' => 'logout')); ?></p>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('title', 'Title'); ?></th>
        <th><?php echo $this->Paginator->sort('created', 'created'); ?></th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
 
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<?php echo $this->Paginator->first(__(' < ', true), array('class' => 'number-first'));?>
<?php echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false));?>
<?php echo $this->Paginator->last(__(' > ', true), array('class' => 'number-end'));?>