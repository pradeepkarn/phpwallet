<nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
	<div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"><a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="{{url('/')}}/admin/dashboard">Voyager Dashboard </a>
	
		<ul class="flex-col md:flex-row list-none items-center hidden md:flex">
			<a class="text-blueGray-500 block" href="#pablo" onclick="openDropdown(event,&quot;user-dropdown&quot;)">
				<div class="items-center flex"><span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="{{Auth::user()->avatar}}"></span></div>
			</a>
			<div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" id="user-dropdown"><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another action</a><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something else here</a>
				<div class="h-0 my-2 border border-solid border-blueGray-100"></div><a href="#pablo" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Seprated link</a></div>
		</ul>
	</div>
</nav>