@extends('layout')

@section('title', isset($result) ? 'Update Result' : 'Add Result')


@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                {{ isset($result) ? 'Update Result' : 'Add Result' }}
            </h4>

        </div>


        <div class="card-body">


            @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif



            <form action="{{ isset($result)
                ? route('results.update',$result->id)
                : route('results.store') }}" method="POST">


                @csrf


                @if(isset($result))

                @method('PUT')

                @endif



                <div class="row">


                    <!-- Student -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Student
                        </label>


                        <select name="student_id" class="form-select" required>

                            <option value="">
                                Select Student
                            </option>


                            @foreach($students as $student)


                            <option value="{{ $student->id }}" {{ old('student_id',$result->student_id ?? '') ==
                                $student->id ? 'selected' : '' }}>

                                {{ $student->roll_number }} -
                                {{ $student->name }}

                            </option>


                            @endforeach


                        </select>

                    </div>




                    <!-- Subject -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Subject
                        </label>


                        <select name="subject_id" class="form-select" required>

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}" {{ old('subject_id',$result->subject_id ?? '') ==
                                $subject->id ? 'selected' : '' }}>


                                {{ $subject->name }}


                            </option>


                            @endforeach



                        </select>


                    </div>





                    <!-- Total Marks -->

                    <div class="col-md-6 mb-3">


                        <label class="form-label">
                            Total Marks
                        </label>


                        <input type="number" name="total_marks" id="total_marks" class="form-control"
                            value="{{ old('total_marks',$result->total_marks ?? '') }}" required>


                    </div>





                    <!-- Obtained Marks -->

                    <div class="col-md-6 mb-3">


                        <label class="form-label">
                            Obtained Marks
                        </label>


                        <input type="number" name="obtained_marks" id="obtained_marks" class="form-control"
                            value="{{ old('obtained_marks',$result->obtained_marks ?? '') }}" required>


                    </div>





                    <!-- Percentage -->

                    <div class="col-md-6 mb-3">


                        <label class="form-label">
                            Percentage
                        </label>


                        <input type="text" id="percentage" class="form-control"
                            value="{{ isset($result) ? $result->percentage.'%' : '' }}" readonly>


                    </div>





                    <!-- Grade -->

                    <div class="col-md-6 mb-3">


                        <label class="form-label">
                            Grade
                        </label>


                        <input type="text" id="grade" class="form-control" value="{{ $result->grade ?? '' }}" readonly>


                    </div>



                </div>



                <button class="btn btn-success">

                    <i class="bi bi-save"></i>

                    {{ isset($result) ? 'Update Result' : 'Save Result' }}

                </button>



                <a href="{{ route('results.index') }}" class="btn btn-secondary">

                    Back

                </a>



            </form>


        </div>


    </div>


</div>





<script>
    function calculateResult(){


    let total = document.getElementById('total_marks').value;

    let obtained = document.getElementById('obtained_marks').value;



    if(total > 0 && obtained >= 0){


        let percentage = ((obtained / total) * 100).toFixed(2);


        document.getElementById('percentage').value = percentage + "%";



        let grade = "";



        if(percentage >= 80){

            grade = "A+";

        }
        else if(percentage >= 70){

            grade = "A";

        }
        else if(percentage >= 60){

            grade = "B";

        }
        else if(percentage >= 50){

            grade = "C";

        }
        else if(percentage >= 40){

            grade = "D";

        }
        else{

            grade = "F";

        }



        document.getElementById('grade').value = grade;


    }


}



document.getElementById('total_marks')
.addEventListener('input',calculateResult);



document.getElementById('obtained_marks')
.addEventListener('input',calculateResult);



</script>


@endsection