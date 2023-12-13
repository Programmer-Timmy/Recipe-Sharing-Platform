
<div class="profile-container">
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Profiel bewerken</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div>
                            <div class="d-flex justify-content-center mb-4">
                                <img id="selectedAvatar" src="<?php echo $user->img_url ?>"
                                     class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;"
                                     alt="example placeholder"/>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile2">Kies afbeelding
                                        <input type="file" class="form-control d-none" accept="image/*" name="avatar"
                                               id="customFile2"
                                           onchange="displaySelectedImage(event, 'selectedAvatar')"/>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <label for="username" class="form-label">Gebruikersnaam:</label>
                        <input type="text" id="username" class="form-control" name="username"
                               value="<?php echo $user->username ?>" placeholder="Enter username">

                        <label for="bio" class="form-label">Beschrijving:</label>
                        <textarea id="bio" class="form-control" name="bio"
                                  placeholder="Enter bio"><?php echo $user->description ?></textarea>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Opslaan">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>


