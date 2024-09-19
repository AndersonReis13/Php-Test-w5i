<?php

enum TaskStatus: string
{
    case Pending = 'pending';
    case Started = 'started';
    case finished = 'paused';
    case Finished = 'finished';

}