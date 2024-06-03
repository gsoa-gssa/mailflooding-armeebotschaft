library(pacman)

p_load(tidyverse)

# Load the data from export-6-emails.csv
email_data <- read_csv("stats/export-6-emails.csv")

View(email_data)

## Calculate the number of rows grouped by email_data$politician
n_emails_politicians <- email_data %>%
    group_by(politician) %>%
    summarise(n = n()) %>%
    arrange(desc(n))

view(n_emails_politicians)

## Calculate the number of rows grouped by email_data$faction
n_emails_factions <- email_data %>%
    group_by(faction) %>%
    summarise(n = n()) %>%
    arrange(desc(n))

## Calculate faction size
faction_size <- email_data %>%
    group_by(faction) %>%
    summarise(faction_size = n_distinct(politician))

## Add to the emai_data dataframe
email_data <- email_data %>%
    left_join(faction_size, by = "faction")

## Calculate the number of rows grouped by email_data$faction and divide it by the faction size
n_emails_factions_size <- email_data %>%
    group_by(faction) %>%
    summarise(n = n()) %>%
    left_join(faction_size, by = "faction") %>%
    mutate(n_per_politician = n / faction_size) %>%
    arrange(desc(n_per_politician))


view(n_emails_factions_size)
