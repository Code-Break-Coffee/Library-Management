<?php

if (!unlink("Doc/Registratinconfirmed.pdf")) { 
    echo (" cannot be deleted due to an error"); 
} 
else { 
    echo ("has been deleted"); 
} 