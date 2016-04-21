<!-- File: /app/View/User/index.ctp -->

<h1>User Record</h1>

<p>
<?php echo $this->Html->link('Your Posts', array('controller' => 'Posts','action' => 'index')); ?>&nbsp;&nbsp;
<?php echo $this->Html->link('All Posts', array('controller' => 'Posts','action' => 'allpost')); ?>&nbsp;&nbsp;
<?php echo $this->Html->link('Logout', array('action' => 'logout')); ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $user['User']['username'],
                    array('action' => 'view', $user['User']['id'])
                );
            ?>
        </td>
        <td>

            <?php
			
				$user_id = $this->Session->read('User.id');
				if($user_id== $user['User']['id']){
			
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $user['User']['id'])
                );
				}
				else
				{
					echo "Not Authorized";
				}
            ?>
        </td>
        <td>
            <?php echo $user['User']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>