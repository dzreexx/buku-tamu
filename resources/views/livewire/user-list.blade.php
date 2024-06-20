<div wire:poll.keep-alive>
    {{-- The best athlete wants his opponent at his best. --}}
    <div style="text-align: center">
        <button wire:click="increment">+</button>
        <h1>{{ $count }}</h1>
    </div>
    <div class="overflow-x-auto">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Job</th>
              <th>Favorite Color</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)    
            <tr>
              <th>{{ $user->nama }}</th>
              <td>Cy Ganderton</td>
              <td>Quality Control Specialist</td>
              <td>Blue</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</div>
