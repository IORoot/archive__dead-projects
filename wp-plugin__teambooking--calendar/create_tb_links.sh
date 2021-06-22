#!/bin/bash

# Create links and backups.

# Calendar.php
./create_symbolic_link.sh \
    ../team-booking/src/TeamBooking/Frontend/Calendar.php \
    ../../../../andyp_teambooking_calendar/shortcodes/calendar_extended/overrides/src/TeamBooking/Frontend/Calendar.php

# Schedule.php
./create_symbolic_link.sh \
    ../team-booking/src/TeamBooking/Frontend/Schedule.php \
    ../../../../andyp_teambooking_calendar/shortcodes/calendar_extended/overrides/src/TeamBooking/Frontend/Schedule.php