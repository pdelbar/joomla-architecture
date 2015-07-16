---
layout: page
title: Joomla 4 Architecture
excerpt: "My thoughts about how I think, Joomla should look like in the future"
tags: [nibralab, joomla, joomla4, pythagoras, orthogonal, architecture]
comments: true
share: true
fork: true
---

The **Hypermedia API** was a "Make it happen" session on J and Beyond 2015 in Prague, lead by Chris Davenport.
The basic idea is to create an interface, that is totally agnostic about the channel, which is used for communication.
That way, the normal web, REST, SOAP, ..., and even the command line can be served by the very same code behind a "channel independency border".

Brainstorming on that idea showed, that it will not be sufficient to build new frontends.
A lot of internal stuff has to be abstracted from the channels.

That's why this project's scope is much wider than just the Hypermedia API.
It will cover the **future architecture of Joomla!** as a whole.