<template>
  <div>
    <teleport to="head">
      <title>{{ title('Admin') }}</title>
    </teleport>
    <div>

      <div>
        Admin-uitleg
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";

export default {
  name: "Index",
  layout: Layout,
  props: {},
};
</script>

