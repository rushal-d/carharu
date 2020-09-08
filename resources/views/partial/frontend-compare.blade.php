<?php $iter = 0; ?>
@if(!empty($mods))
    @foreach($mods as $moo)
        <div class="col-lg-3">
            <div id="accordion">
                @if(!empty($specifications))
                    @foreach($specifications as $specs)
                        @if($specs->id != $colorIdInSpecs->id)
                            <?php $iter++; ?>
                            <div class="other-spec">
                                <div  id="headingOne">
                                    <h3 class="sub-title" data-toggle="" data-target="#collapse{{ $iter }}" aria-expanded="true" aria-controls="collapseOne">{{$specs->specification}}</h3>
                                </div>
                                <div id="collapse{{ $iter }}" class="collapse show" aria-labelledby="{{$iter}}" data-parent="#accordion">
                                    <div class="other-specs">
                                        <table class="table">
                                            @if(!empty($moo->detail))
                                                @foreach($moo->detail as $mo)
                                                    @if($mo->feature->spec->specification == $specs->specification )
                                                        <tbody>
                                                        <tr>
                                                            <td scope="row">{{$mo->feature->feature}}</td>
                                                            <td align="right"><b>{{$mo->value}}</b></td>
                                                        </tr>
                                                        </tbody>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div><!-- close og col 8 -->
    @endforeach
@endif
