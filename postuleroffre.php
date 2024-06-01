<!-- Modal for CV -->
<div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cvModalLabel">Postuler avec votre CV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="traitement_cv.php" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age">Age :</label>
                <input type="text" id="age" name="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="experience">Expérience :</label>
                <textarea id="experience" name="experience" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="competences">Compétences :</label>
                <textarea id="competences" name="competences" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="education">Éducation :</label>
                <textarea id="education" name="education" class="form-control" rows="4" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>