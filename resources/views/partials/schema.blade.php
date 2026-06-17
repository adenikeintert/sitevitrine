@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "{{ $infos['nom_societe'] ?? 'ADENIKE-INTER SARL' }}",
    "url": "{{ url('/') }}",
    "logo": "{{ $infos['logo'] ?? '' }}",
    "telephone": "{{ $infos['telephone'] ?? '' }}",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $infos['adresse'] ?? '' }}",
        "addressCountry": "BJ"
    }
}
</script>
@endpush