#!/bin/bash

# Remove links and move backups.

# Calendar.php
./remove_symbolic_link.sh \
    ../team-booking/src/TeamBooking/Frontend/Calendar.php 

# Schedule.php
./remove_symbolic_link.sh \
    ../team-booking/src/TeamBooking/Frontend/Schedule.php 