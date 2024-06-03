library(pacman)

p_load(tidyverse)

# Load the data from export-5-emails.csv
email_data <- read_csv("stats/export-5-emails.csv")

View(email_data)

## Calculate the number of rows grouped by email_data$politician
n_emails <- email_data %>%
    group_by(politician) %>%
    summarise(n = n()) %>%
    arrange(desc(n))

view(n_emails)
