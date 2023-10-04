@extends('layouts.app')

@section('content')
    <style>
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
    <main class="min-height-page main">	        		
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-12 mx-auto">                                                       
                    <div class="heading mb-1">
                        <h2>Report a case of trafficking</h2>
                    </div> 
                    <!-- Privacy Policy -->
                    <div class="mb-5">
                        <div>
                            <h4>Advocacy Against Trafficking</h4>
                        </div>
                        <div>
                            <p>
                                PatronCastle is fully dedicated to promoting awareness about the problem of human trafficking and actively participates in the implementation of best practices and advocacy efforts. Should we become aware of any trafficking incidents, we wholeheartedly collaborate with law enforcement and organizations committed to combating human rights violations.
                            </p>
                            
                            <p>
                                <strong>If you suspect any instances of sexual exploitation involving minors and/or human trafficking, please promptly report them to the relevant authorities.</strong>
                            </p>
                            <ul>
                                <li><a href="https://www.childrenofthenight.org/" target="_blank">Children of the Night</a></li>
                                <li><a href="https://www.hhs.gov/" target="_blank">Dept. of Health & Human Services</a></li>    
                                <li><a href="https://www.missingkids.org/HOME" target="_blank">National Center for Missing & Exploited Children (NCMEC)</a></li>
                                <li><a href="https://report.cybertip.org/" target="_blank">CyberTipline </a>- Notify authorities of child exploitation</li>
                                <li><a href="https://polarisproject.org/" target="_blank">Polaris Project </a>- Report a Case of Human Trafficking</li>                                                            
                            </ul>

                            <p>
                                INDICATORS THAT MAY SUGGEST HUMAN TRAFFICKING
                            </p>
                            <ul>
                                <li>Does the performer appear to be underage or appear to be very close to being underage?</li>
                                <li>Does the performer exhibit signs of fear or unease in the presence of that individual?</li>
                                <li>Is the performer accompanied by another person upon arrival?</li>
                                <li>Does this individual seem to speak on behalf of or exert control over the performer?</li>                                
                                <li>Is the performer experiencing communication challenges, possibly due to a language barrier or apprehension?</li>                                
                            </ul>
                            
                        </div>                        
                    </div>                     



                </div>
            </div>
        </div>
    </main><!-- End .main -->   
@endsection