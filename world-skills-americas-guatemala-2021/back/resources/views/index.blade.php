<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>
</head>
<body>

<header>
   <a href='/XX_module05'>job indicator</a>
   <a href='/XX_module05/joblist'>job indicator list</a>
</header>

@if($title == 'Job Indicator List')
<div class="title"><h1>{{ $title }}</h1> 
<a class='btn' href='/XX_module05/create-job'>New Job</a></div>
@else
<h1>{{ $title  }}</h1>
@endif


@if($title == 'Create Job') 
@if ($errors->has('score'))
    <div class="alert alert-danger">
        {{ $errors->first('score') }}
    </div>
@endif
<form method='POST'>
   @csrf
   <input type='text' name='job' placeholder='Enter job name...' value='{{old('job')}}' required  />
   
   <div class='competentions'>
      <div class='job__competition'>
         <input type='text' name='competence[]' placeholder='name...' required/>
         <input type='text' name='height[]' placeholder='height...' required/>
      </div>
   </div>

   <span class='btn' id='addNewCompetention'>+ competention</span>

   <button class='btn'>save</button>
</form>
@else
<div class="jobs">
   @foreach($jobs as $job)
      <div class='job'>
         <div class='job__header'>
            <h2>{{ $job->job }}</h2>
            <div>
               @if($title != 'Job Indicator')
               <b>{{ $job->users->count() }}</b>
               @endif
            <a class="job__header__open">open</a>
            </div>
         </div>
      @if($title == 'Job Indicator')
         <form class="job__content"  style="display: none" method="POST">
            <input type='hidden' name='job' value='{{ $job->id }}' />
            <h3>Competentces Level</h3>
            @foreach($job->competentions as $competition)
               <div class="job__competition" >
                  @csrf
                  <select name="levels[]" id="" required>
                     <option value="" disabled selected>Select Your Level </option>
                     @foreach($levels as $level)
                        <option value="{{  $level->level  }}">{{  $level->level  }} </option>
                     @endforeach
                  </select>
                  <span>
                  <input type='hidden' name='heights[]' value='{{ $competition->height }}' />
                  <input type='hidden' name='types[]' value='{{ $competition->competence }}' />
                  <h4>{{ $competition->competence  }}</h4>
                  </span>
               </div>
            @endforeach
            <input type='text' name='name' placeholder='Complete Name' value='{{old('name')}}' required class='name'  />
            <input type='email' name='email' placeholder='Email' value='{{old('email')}}' required class='email' />
            <input type='text' name='phone' placeholder='Phone Number' value='{{old('phone')}}' required class='phone'  />
            <button class='btn'>save</button>
         </form>
      @else
         <div class="job__content"  style="display: none">
            @foreach($job->users->sortByDesc('points') as $job)
            <div class="job">
               <div class='job__header'>
                  <h3>{{ $job->name }}</h3>
                  <div>
                     <b>{{ $job->points  }}</b>
                     <a class="job__header__open">open</a>
                  </div>
               </div>
               <div class="job__content"  style="display: none">
                  <p><b>E-mail: </b>{{ $job->email }}</p>
                  <p><b>Phone Number: </b>{{ $job->phone }}</p>
                  <h3>Competences Levels</h3>
                  @foreach(json_decode($job->knowledges) as $key => $value)
                  <div class="job__competition" >
                     <span>{{ $key }}</span>
                     <span>{{$value }}</span>
                  </div>  
                  @endforeach
               <p class='job__right'>{{ $job->created_at }}</p>
               </div>
            </div>
            @endforeach
         </div>
      @endif
      </div>
   @endforeach
</div>
@endif
<style>
* {
   box-sizing: border-box;
   padding: 0;
   margin: 0;
   text-decoration: none;
   outline: none;
}
body {
   background-color: #202020;
   color: #fdfbfb;
   overflow-x: hidden;
   font-size: 20px;
   font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

   display: flex;
   justify-content: center;
   align-items: center;
   flex-direction: column;
   width: 100%;
   row-gap: 15px;
}
.title {
   display: flex;
   justify-content:space-between;
   align-items: center;
   width: 100%;
   max-width: 500px
}
h1 {
   text-shadow: 3px 3px 1px lightskyblue;
}
a {
   color: #fdfbfb;
   transition:  all .3s linear;
   text-transform: capitalize;
}
a:hover {
   color: lightskyblue;
   cursor: pointer;
}
header {
    border-bottom: 2px solid white;
   /* background-color: rgb(254,2543,254,.08); */
   height: 80px;
   padding: 0 5vw;
   display: flex;
   justify-content: end;
   align-items: center;
   gap: 30px;
   width: 100%;
}
header a:hover {
   background-color: lightskyblue;
   color: black;
   padding: 10px;
}
.jobs {
   display: flex;
   justify-content: center;
   flex-direction: column;
   align-items: center;
   width: 100%;
   margin-bottom: 10%;
}
.job {
   width: 100%;
   max-width: 500px;
   margin: 10px;
   border-radius: 10px;
   border: 2px solid white;
}
.job__header {
   border-bottom: 2px solid white;
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 10px ;
   gap: 10px;
   border-radius: 10px;
}
.job__header div {
   display: flex;
   justify-content: center;
   align-items: center;
   gap: 10px
}
.job__content {
   padding: 10px;
}
.job__content h3 {
   margin-bottom: 10px;
}
.job__competition {
   display: flex;
   justify-content: space-between;
   align-items: center;
   width: 100%;
}
.job__competition span {
   display: flex;
   justify-content: start;
   align-items: center;
   width: 70%;
}
select {
   font-size: 18px;
   margin-right: 10px;
   border: 2px solid white;
   border-radius: 10px;
   background-color: transparent;
   color: white;
   padding: 4px 6px;
   cursor: pointer;
}
option {
   padding: 4px 10px;
   background-color: #202020;
}
.job__competition {
   margin-bottom: 5px;
}
.job__right {
   width: 100%;
   text-align: right
}

::-webkit-scrollbar {
   background-color: transparent;
   border: 2px solid white;
}
::-webkit-scrollbar-thumb {
   background-color: lightskyblue;
   /* border-radius: 10px; */
}
input {
   font-size: 18px;
   margin-right: 10px;
   border: 2px solid white;
   border-radius: 10px;
   background-color: transparent;
   color: white;
   padding: 8px 10px;
   cursor: pointer;
   width: 100%;
   margin-bottom: 10px;
}
input:hover, input:focus, select:hover, select:focus {
   border: 2px solid lightskyblue;
}
.btn {
   border: 2px solid white;
   padding: 8px 10px;
   transition: all .3s linear;
   color: white;
   border-radius: 10px;
   font-size: 18px;
   background-color: transparent;
}
.btn:hover {
   border-color:  lightskyblue;
   color: lightskyblue;
   cursor: pointer;
}
::selection {
   background-color: lightskyblue;
   color: black;;
}
.competentions {

}
</style>

<script>
const job__content = document.querySelectorAll('.job__content')
const job__header__open = document.querySelectorAll('.job__header__open')

for (let i = 0; i < job__header__open.length; i++) {
   job__header__open[i].addEventListener('click', () => {
      if ( job__content[i].style.display == 'none') {
         job__content[i].style.display = 'block'
         job__header__open[i].innerHTML = 'close'
      } else {
         job__content[i].style.display = 'none'
         job__header__open[i].innerHTML = 'open'
      }
   })
}

const emails = document.querySelectorAll('.email')
const phones = document.querySelectorAll('.phone')
const names = document.querySelectorAll('.name')


for (let i = 0; i < emails.length; i++) {
   emails[i].addEventListener('change', async (e) => {
      console.log(e.target.value)

      let response = await fetch(`/api/users`, {
         method: 'POST',
         headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
         },
         body: JSON.stringify({
            "email": e.target.value
         })
      })
      let data = await response.json()

      if (data.name != undefined) {
         names[i].value = data.name
         phones[i].value = data.phone
      }
})
}

const addNewCompetention = document.querySelector('#addNewCompetention')
const competentions = document.querySelector('.competentions')

if (addNewCompetention) {
   addNewCompetention.addEventListener('click', () => {
   competentions.innerHTML += `
      <div class='job__competition'>
         <input type='text' name='competence[]' placeholder='name...' required/>
         <input type='text' name='height[]' placeholder='height...' required/>
      </div>
   `
})
}
</script>

</body>
</html>