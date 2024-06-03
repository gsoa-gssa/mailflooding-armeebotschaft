library(pacman)
p_load(tidyverse, cli)

# Load data
df_contacts <- read_csv("stats/export-contacts.csv")

df_contacts <- df_contacts %>%
    mutate(
        created_at = as.Date(created_at),
        updated_at = as.Date(updated_at),
        optin = as.logical(optin),
        sha_email = hash_sha256(tolower(email))
    ) %>%
    mutate(
        optin = ifelse(is.na(optin), FALSE, optin)
    )

df_sha <- read_csv("stats/sha_emails.csv")

## Check if df_contacts$sha_email is in df_sha$emails_hash
df_contacts <- df_contacts %>%
    mutate(
        in_sha = sha_email %in% df_sha$emails_hash
    )

view(df_contacts)

## Calculate rate of new contacts and new contacts where optin = TRUE
df_new_contacts <- df_contacts %>%
    summarise(
        new_contacts = sum(!in_sha),
        new_contacts_optin = sum(!in_sha & optin),
        total_contacts = n(),
        total_contacts_optin = sum(optin)
    ) %>%
    mutate(
        new_contact_rate = new_contacts / total_contacts,
        new_contact_rate_optin = new_contacts_optin / total_contacts_optin,
        new_contact_rate_optin_to_total = new_contacts_optin / total_contacts
    )

view(df_new_contacts)
