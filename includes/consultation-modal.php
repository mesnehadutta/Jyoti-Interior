<div class="modal fade" id="consultationModal" tabindex="-1" role="dialog" aria-labelledby="consultationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content rounded">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="consultationModalLabel">Get Free Consultation</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="free_consult.php" method="POST">
          <div class="form-group">
            <label for="consult-name">Your Name</label>
            <input type="text" class="form-control" id="consult-name" name="name" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label for="consult-email">Email address</label>
            <input type="email" class="form-control" id="consult-email" name="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="consult-phone">Phone</label>
            <input type="number" class="form-control" id="consult-phone" name="phone" placeholder="Enter phone no." required>
          </div>
          <div class="form-group">
            <label for="consult-message">Message</label>
            <textarea class="form-control" id="consult-message" name="message" rows="3" placeholder="Your query..." required></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-warning text-dark">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
