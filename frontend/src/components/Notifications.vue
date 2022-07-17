<template>
  <v-app id="inspire">
    <v-card
      height="300"
      flat
    >
    <p>OI</p>
      <v-snackbar
        :timeout="-1"
        :value="true"
        absolute
        bottom
        color="success"
        outlined
        right
      >
        snackbar with <strong>outlined</strong> property.
      </v-snackbar>
    </v-card>
  </v-app>
</template>

<script>
export default {
  name: "notification"

}
</script>

