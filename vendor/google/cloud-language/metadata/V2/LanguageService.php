<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/language/v2/language_service.proto

namespace GPBMetadata\Google\Cloud\Language\V2;

class LanguageService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\Client::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        $pool->internalAddGeneratedFile(
            '
�#
/google/cloud/language/v2/language_service.protogoogle.cloud.language.v2google/api/client.protogoogle/api/field_behavior.proto"�
Document5
type (2\'.google.cloud.language.v2.Document.Type
content (	H 
gcs_content_uri (	H 
language_code (	B�A"6
Type
TYPE_UNSPECIFIED 

PLAIN_TEXT
HTMLB
source"t
Sentence0
text (2".google.cloud.language.v2.TextSpan6
	sentiment (2#.google.cloud.language.v2.Sentiment"�
Entity
name (	3
type (2%.google.cloud.language.v2.Entity.Type@
metadata (2..google.cloud.language.v2.Entity.MetadataEntry9
mentions (2\'.google.cloud.language.v2.EntityMention6
	sentiment (2#.google.cloud.language.v2.Sentiment/
MetadataEntry
key (	
value (	:8"�
Type
UNKNOWN 

PERSON
LOCATION
ORGANIZATION	
EVENT
WORK_OF_ART
CONSUMER_GOOD	
OTHER
PHONE_NUMBER	
ADDRESS

DATE

NUMBER	
PRICE"-
	Sentiment
	magnitude (
score ("�
EntityMention0
text (2".google.cloud.language.v2.TextSpan:
type (2,.google.cloud.language.v2.EntityMention.Type6
	sentiment (2#.google.cloud.language.v2.Sentiment
probability ("0
Type
TYPE_UNKNOWN 

PROPER

COMMON"1
TextSpan
content (	
begin_offset (":
ClassificationCategory
name (	

confidence ("�
AnalyzeSentimentRequest9
document (2".google.cloud.language.v2.DocumentB�A=
encoding_type (2&.google.cloud.language.v2.EncodingType"�
AnalyzeSentimentResponse?
document_sentiment (2#.google.cloud.language.v2.Sentiment
language_code (	5
	sentences (2".google.cloud.language.v2.Sentence
language_supported ("�
AnalyzeEntitiesRequest9
document (2".google.cloud.language.v2.DocumentB�A=
encoding_type (2&.google.cloud.language.v2.EncodingType"�
AnalyzeEntitiesResponse2
entities (2 .google.cloud.language.v2.Entity
language_code (	
language_supported ("P
ClassifyTextRequest9
document (2".google.cloud.language.v2.DocumentB�A"�
ClassifyTextResponseD

categories (20.google.cloud.language.v2.ClassificationCategory
language_code (	
language_supported ("P
ModerateTextRequest9
document (2".google.cloud.language.v2.DocumentB�A"�
ModerateTextResponseO
moderation_categories (20.google.cloud.language.v2.ClassificationCategory
language_code (	
language_supported ("�
AnnotateTextRequest9
document (2".google.cloud.language.v2.DocumentB�AM
features (26.google.cloud.language.v2.AnnotateTextRequest.FeaturesB�A=
encoding_type (2&.google.cloud.language.v2.EncodingType�
Features
extract_entities (B�A\'
extract_document_sentiment (B�A
classify_text (B�A
moderate_text (B�A"�
AnnotateTextResponse5
	sentences (2".google.cloud.language.v2.Sentence2
entities (2 .google.cloud.language.v2.Entity?
document_sentiment (2#.google.cloud.language.v2.Sentiment
language_code (	D

categories (20.google.cloud.language.v2.ClassificationCategoryO
moderation_categories (20.google.cloud.language.v2.ClassificationCategory
language_supported (*8
EncodingType
NONE 
UTF8	
UTF16	
UTF322�
LanguageService�
AnalyzeSentiment1.google.cloud.language.v2.AnalyzeSentimentRequest2.google.cloud.language.v2.AnalyzeSentimentResponse"M�Adocument,encoding_type�Adocument���#"/v2/documents:analyzeSentiment:*�
AnalyzeEntities0.google.cloud.language.v2.AnalyzeEntitiesRequest1.google.cloud.language.v2.AnalyzeEntitiesResponse"L�Adocument,encoding_type�Adocument���""/v2/documents:analyzeEntities:*�
ClassifyText-.google.cloud.language.v2.ClassifyTextRequest..google.cloud.language.v2.ClassifyTextResponse"0�Adocument���"/v2/documents:classifyText:*�
ModerateText-.google.cloud.language.v2.ModerateTextRequest..google.cloud.language.v2.ModerateTextResponse"0�Adocument���"/v2/documents:moderateText:*�
AnnotateText-.google.cloud.language.v2.AnnotateTextRequest..google.cloud.language.v2.AnnotateTextResponse"[�Adocument,features,encoding_type�Adocument,features���"/v2/documents:annotateText:*z�Alanguage.googleapis.com�A]https://www.googleapis.com/auth/cloud-language,https://www.googleapis.com/auth/cloud-platformBp
com.google.cloud.language.v2BLanguageServiceProtoPZ8cloud.google.com/go/language/apiv2/languagepb;languagepbbproto3'
        , true);

        static::$is_initialized = true;
    }
}

