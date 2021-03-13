<div class="modal fade" id="rating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Rate The Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ratings.store') }}" id="ratingform" method="POST">
                    @csrf
                    <div class="rating" style="text-shadow: none">
                        <label>
                            <input type="radio" name="rating" value="1" required />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="rating" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <textarea name="comment" placeholder="Describe your satisfaction" class="form-control" rows="5"
                            required></textarea>
                    </div>
                    <input type="hidden" name="order_id" value="{{ $orderid }}">
                    <input type="hidden" name="service_id" value="{{ $serviceid }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" form="ratingform" class="btn btn-primary" value="Send Rating" />
            </div>
        </div>
    </div>
</div>
