<?php
    require_once "template/header.php";
?>

    <div class="container ">
       <div class="row vh-100 justify-content-center align-items-center">
           <div class="col-11">
               <div class=" card overflow-hidden border-0 bg-white p-3 rounded">
                           <h2 class="text-info text-center">
                               <i class="feather-users text-info"></i>
                               Contact Lists
                           </h2>
                           <hr class="text-info my-0">
                           <div class="mb-1 d-flex justify-content-between">
                               <a href="index.php" class="text-decoration-none" aria-current="page">
                                   <i class="feather-list text-black-50 fs-2"></i>
                               </a>
                               <a href="contact_add.php" class="text-decoration-none">
                                   <span class="fs-4 rounded text-info d-flex align-items-center">
                                       <i class="feather-plus-circle me-1"></i>
                                       Add New Contact
                                   </span>
                               </a>
                           </div>
                           <table class="table table-bordered border-info table-hover text-center">
                               <thead>
                               <tr>
                                   <td>#</td>
                                   <td>Profile</td>
                                   <td>Name</td>
                                   <td>Phone</td>
                                   <td>Email</td>
                                   <td>Control</td>
                                   <td>Created_At</td>
                               </tr>
                               </thead>
                               <tbody class="border-info">
                               <?php foreach (fetchContacts() as $contact){ ?>
                                   <tr>
                                       <td><?php echo $contact['id'] ?></td>
                                       <td><img src="css/images/<?php echo $contact['photo_name'] ?>" alt="" class="custom-img"></td>
                                       <td><?php echo $contact['name'] ?></td>
                                       <td><?php echo $contact['phone'] ?></td>
                                       <td><?php echo $contact['email'] ?></td>
                                       <td>
                                           <a href="update_contact.php?id=<?php echo $contact['id']; ?>" class="text-decoration-none text-light bg-info p-1 rounded me-1">
                                               <i class="feather-edit" class=""></i>
                                           </a>
                                           <a href="delete_contact.php?id=<?php echo $contact['id']; ?>" class="text-decoration-none text-light bg-danger p-1 rounded">
                                               <i class="feather-trash-2" class=""></i>
                                           </a>
                                       </td>
                                       <td><?php echo date('d-m-Y',strtotime( $contact['created_at'])); ?></td>
                                   </tr>
                               <?php } ?>
                               </tbody>
                           </table>
                       </div>
           </div>
       </div>
    </div>

<?php require_once "template/footer.php"?>