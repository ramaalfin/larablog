<div>
  <form method="post" wire:submit.prevent="UpdateDetails()">
    <div class="row">
      <div class="col-md-4">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" placeholder="Name" wire:model="name">
        </div>  
      </div>
      <div class="col-md-4">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" placeholder="Username" wire:model="username">
        </div>  
      </div>
      <div class="col-md-4">
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="text" class="form-control" placeholder="email" disabled wire:model="email">
        </div>  
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Biography</label>
      <textarea class="form-control" rows="7" placeholder="Biography" wire:model="bio">Biography...</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
  </form>
</div>
