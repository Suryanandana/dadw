@section('title', 'Profile')

@section('head')
{{-- font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
    rel="stylesheet">
{{-- flowbite js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
{{-- font awesome --}}
<script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
@endsection

@section('navbar')
    <livewire:customer.navbar>
@endsection

<div class="max-w-screen-xl mx-auto mt-14 p-14">
        <form class="flex flex-col gap-4 mb-4 md:flex-row" wire:submit='validateForm' enctype="multipart/form-data">
            <div class="flex flex-col items-center flex-shrink gap-3 place-self-center">
                <span class="font-semibold">Profile Picture</span>
                <label for="choose-file" class="md:mx-12 hover:cursor-pointer">
                    <div id="img-preview" class="grid border-2 rounded-full border-neutral-400 size-32 md:size-80 place-content-center place-items-center">
                        <svg class="text-green-600/50 size-18" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                            <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                            <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                            <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                            <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                            <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                        </svg>
                        <div class="hidden md:block ">
                            <center class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></center>
                            <center class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or Webp</center>
                        </div>
                    </div>
                    <input class="hidden" name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp">
                </label>
            </div>
            <div class="flex flex-col self-start flex-grow w-full gap-3">
                <div>
                    <label for="Email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input wire:model.live.debounce.200ms='Email' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('Email') {{'outline-red-400 border-red-400'}} @enderror
                    " value="{{$user->email}}" disabled/>
                    <div>
                        @error('Email')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                    <input wire:model.live.debounce.200ms='name' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('name') {{'outline-red-400 border-red-400'}} @enderror
                    " value="{{$user->name}}"/>
                    <div>
                        @error('name')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="Phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                    <input wire:model.live.debounce.200ms='Phone' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('Phone') {{'outline-red-400 border-red-400'}} @enderror
                    " value="{{$user->phone}}"/>
                    <div>
                        @error('Phone')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="Address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <textarea wire:model.live.debounce.200ms='Address' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('Address') {{'outline-red-400 border-red-400'}} @enderror
                    " value="{{$user->address}}" rows="3"></textarea>
                    <div>
                        @error('Address')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="Country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                    <input wire:model.live.debounce.200ms='Country' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('Country') {{'outline-red-400 border-red-400'}} @enderror
                    " value="{{$user->country}}"/>
                    <div>
                        @error('Country')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-3">
                    @if (!empty($user->password))
                    <button x-on:click="$wire."
                        class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-bg-cyan-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Change Password
                    </button>
                    @endif
                    <div class="grid w-full grid-cols-2 gap-3 place-self-end">
                        <button x-on:click="$wire."
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Cancel
                        </button>
                        <button x-on:click="$wire.submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
</div>
<script>
    const chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");
    
    chooseFile.addEventListener("change", function () {
        getImgData();
      });
      
      function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
          const fileReader = new FileReader();
          fileReader.readAsDataURL(files);
          fileReader.addEventListener("load", function () {
            imgPreview.style.display = "block";
            imgPreview.innerHTML = '<img class="my-auto rounded-full aspect-square" src="' + this.result + '" />';
          });    
        }
      }
</script>