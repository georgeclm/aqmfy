  <?php $count = Auth::user()->newThreadsCount(); ?>
  @if ($count > 0)
      <span class="badge badge-pill bg-danger">{{ $count }}</span>
  @endif
